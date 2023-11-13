<?php

use yii\db\Migration;

/**
 * Class m231113_121458_random_image_decisions
 */
final class m231113_121458_random_image_decisions extends Migration
{
    const TABLE_NAME = '{{%random_image_decisions}}';

    public function up(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer()->notNull()->unique(),
            'result' => $this->boolean()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    public function down(): void
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
