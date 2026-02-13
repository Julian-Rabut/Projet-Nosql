<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/config/mongodb.php';

final class DatabaseTest extends TestCase
{
    public function testCanConnectAndReadCounts(): void
    {
        $db = mongo_db();

        $this->assertIsInt($db->users->countDocuments());
        $this->assertIsInt($db->venues->countDocuments());
        $this->assertIsInt($db->activities->countDocuments());
        $this->assertIsInt($db->reviews->countDocuments());
    }

    public function testActivitiesHaveVenueIdAndCreatedBy(): void
    {
        $db = mongo_db();
        $one = $db->activities->findOne();

        if (!$one) {
            $this->markTestSkipped("Aucune activité en base (lance seed_data.php).");
        }

        $this->assertArrayHasKey('venueId', $one);
        $this->assertArrayHasKey('createdBy', $one);
    }
}
