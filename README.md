# Exam Import System

This project demonstrates a flexible, clean and extensible architecture for importing data (e.g., Users) from various formats such as CSV, JSON or XML.

## 🧠 Architecture Highlights

- **GenericEntityMapper**: Maps normalized array keys to entity setters (e.g., `firstname` → `setFirstName()`).
- **KeyNormalizerInterface**: Allows consistent normalization of keys across formats.
- **DefaultKeyNormalizer**: Default implementation that removes spaces, dashes, and underscores from keys and lowercases them.
- **GenericCsvImporter**: General-purpose CSV importer using dependency-injected components.
- **ImporterManager**: Handles mapping of import tasks (e.g. `user_csv`) to specific importer instances.
- **Enum-based keys**: `ImportTask` enum is used to organize import definitions clearly and safely.

---

## 🔄 `GenericEntityMapper` Behavior

If your data source uses column names that match the normalized form of entity attributes, **no explicit mapping is required**.

```php
$mapper = new GenericEntityMapper(UserEntity::class);
```

This will automatically map:
```
First Name → setFirstName
first_name → setFirstName
first-name → setFirstName
```

All thanks to the `DefaultKeyNormalizer`.

---

If your data source has different column names, you can pass a mapping array:

```php
$mapper = new GenericEntityMapper(UserEntity::class, [
    'prijmeni' => 'lastName',
]);
```

Only fields not matching the normalized attribute name need to be listed.

---

## ✅ Example Import Execution

```php
$repository = new UserRepository();
$normalizer = new DefaultKeyNormalizer();
$mapper = new GenericEntityMapper(UserEntity::class);

$csvImporter = new CsvImporter($repository, $mapper, $normalizer);

$manager = new ImporterManager([
    ImportTask::USER_CSV->value => $csvImporter,
]);

$manager->run(ImportTask::USER_CSV->value, 'path/to/sample.csv');
```

---

## 📂 Extending for Other Entities or Formats

To add support for a new import type (e.g., `voucher_json`):

1. Create an importer class (e.g., `JsonImporter`).
2. Create entity & repository if needed.
3. Add entry to `ImporterManager`.

With normalized keys and optionally passed field map, the same `GenericEntityMapper` can be reused.

---

Made with ❤️ by Adam


# XXXXX import exam

Your task in this simple exam is to import a CSV file containing users, using an existing model.

## Requirements
* You should not modify model files.
* You should not use any external libraries.
* Consider e-mail as a unique column.
* Consider that the application will be extended in the future with additional imports (such as vouchers) from various file types (such as json).
* When you are done, create a new branch in this repository and send a pull request.

