<?php

use App\Models\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\PostgresConnection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('article', 255)->unique();
            $table->string('name', 255);
            $table->string('status', 255);
            $table->jsonb('data');

            $table->timestamps();
            $table->softDeletes();
        });

        if ($this->databaseSupportsCheckConstraint()) {
            $this->addCheckStatusConstraint();
        }
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }

    private function addCheckStatusConstraint(): void
    {
        $possibleStatuses = "'" . $this->collectPossibleStatuses()
                ->map(fn(Status $status) => $status->value)
                ->join("', '") . "'";

        if ("''" === $possibleStatuses) {
            throw new LogicException('Invalid check_status constraint.');
        }

        DB::statement("ALTER TABLE products ADD CONSTRAINT check_status CHECK ( status IN ($possibleStatuses) );");
    }

    private function databaseSupportsCheckConstraint(): bool
    {
        $connection = DB::connection();

        return $connection instanceof PostgresConnection
            || $connection instanceof MySqlConnection;
    }

    /**
     * @return Collection<Status>
     */
    private function collectPossibleStatuses(): Collection
    {
        return collect(Status::cases());
    }
};
