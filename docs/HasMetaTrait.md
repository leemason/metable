## The HasMeta Trait

The ```HasMeta``` trait is where all of the packages public methods are stored.

To use simply:

1. Import the class.
2. ```use``` the trait in your Eloquent model
3. Set the protected ```$metaModel``` property to the fully namespaced class of the to be associated model (this model must use the ```Metable``` trait, which is documented in its own page).
4. OPTIONAL set the protected ```$metaForeignKey``` to the column name where the relationship id will be stored.*


* If this isn't set the trait will apply some common sense formatting and convert the models classname using the ```snake_case``` function appened with "_id".
So ```SomeModel``` would become ```some_model_id```. This column would need to exist on the meta models table.

```php

<?php

use LeeMason\Metable\HasMeta;

class SomeModel extends Eloquent{
    use HasMeta;

    protected $metaModel = 'Some\Namespaced\MetaModel';
}

```

That's it! All of the meta manipulation functions/properties are now available to you.
Check them out below:

---

### meta()

The standard Eloquent relationship function which returns the relation builder

---

### meta

The standard Eloquent relationship collection fetched by the builder

---

### getMeta($key = false)

If ```$key``` is false returns the equivalant of ```$this->meta()->get();```.
If ```$key``` is set and the meta model exists it will return the formatted value.
Otherwise returns false.

---

### addMeta($key, $value)

Loads or creates the meta model by ```$key```, sets the ```$value``` and saves to the db.

---

### updateMeta($key, $value)

Semantic wrapper around the ```addMeta()``` function.

---

### deleteMeta($key)

Deletes the meta model record and relationship from the db.

---

### fillMeta(array $meta)

Allows you to provide an associative key => value array of multiple meta records and bulk save them to the db.





