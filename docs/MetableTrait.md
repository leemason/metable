## The Metable Trait

The ```Metable``` trait provides all of the background value formatting functionality needed to store variable values on your meta model.

This trait can be used with any Eloquent model which will be associated as a meta model to a higher level model.

Using this trait requires that the table for the meta model must contain ```id``` (int, auto increment), ```key``` (string), ```type``` (string), ```value``` (string), ```$relation_id``` columns (see the database structure docs for full information).

The meta model itself can optionally contain extra attributes, however take note any extra attributes would need to be set on the model seperatley from the ```***Meta()``` helper functions.

The model this trait is used in would also ideally have the ```$fillable``` and ```$casts``` property set like so:

```php

/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $fillable = ['key', 'value'];

/**
 * How to treat each attribute.
 *
 * @var array
 */
protected $casts = [
    'key' => 'string',
    'value' => 'string',
];

```

However included with the package is a base ```MetaModel``` which extends Eloquent, already uses the trait, and sets the ```$fillable```, ```$casts``` properties.

In most cases you can simply extend this model in your meta model and would only need to use the trait seperatley on models that required additional functionality.