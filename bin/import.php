<?php declare(strict_types = 1);

use Adbros\Exam\Model\User\UserRepository;
use Adbros\Exam\Import\GenericEntityMapper;
use Adbros\Exam\Import\Csv\CsvImporter;
use Adbros\Exam\Import\ImporterManager;
use Adbros\Exam\Import\Utils\DefaultKeyNormalizer;
use Adbros\Exam\Model\User\UserEntity;

require __DIR__ . '/../vendor/autoload.php';

$repository = new UserRepository();
$normalizer = new DefaultKeyNormalizer();
$mapper = new GenericEntityMapper(UserEntity::class);

$csvImporter = new CsvImporter($repository, $mapper, $normalizer);

$manager = new ImporterManager([
    \Adbros\Exam\Enum\ImportTask::USER_CSV->value => $csvImporter,
]);

$file = __DIR__ . '/../data/sample.csv';

if (!file_exists($file)) {
    die("File not found: $file");
}

$manager->run(\Adbros\Exam\Enum\ImportTask::USER_CSV->value, $file);
foreach ($repository->findAll() as $user) {
    echo sprintf(
        "%s %s <%s>\n",
        $user->getFirstName(),
        $user->getLastName(),
        $user->getEmail()
    );
}
