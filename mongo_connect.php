<?php
// MongoDB connection helper for the project.
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

if (!class_exists('MongoDB\\Client')) {
    die('MongoDB PHP library is not installed. Install the mongodb extension and the mongodb/mongodb library via Composer.');
}

/**
 * Returns a shared MongoDB client instance.
 *
 * @return MongoDB\\Client
 */
function getMongoClient(): MongoDB\\Client
{
    static $client = null;

    if ($client === null) {
        $client = new MongoDB\\Client('mongodb://127.0.0.1:27017');
    }

    return $client;
}

/**
 * Returns the department database instance.
 *
 * @return MongoDB\\Database
 */
function getMongoDB(): MongoDB\\Database
{
    static $db = null;

    if ($db === null) {
        $db = getMongoClient()->selectDatabase('department');
    }

    return $db;
}

/**
 * Converts a value to MongoDB ObjectId if possible.
 * Leaves the value unchanged if conversion is not possible.
 *
 * @param mixed $id
 * @return mixed
 */
function toMongoId($id)
{
    if ($id instanceof MongoDB\\BSON\\ObjectId) {
        return $id;
    }

    try {
        return new MongoDB\\BSON\\ObjectId($id);
    } catch (Throwable $e) {
        return $id;
    }
}
