## Laravel Metable Package

The Laravel Eloquent Metable Package is designed specifically for associating "meta" information to an Eloquent model.

There are many use cases for this, most notably a User model where you may need the ability to assign multiple different types of profile information.

Ideally you would always provide unique columns on your model tables to handle all of the data, but in more dynamic applications this may not always be a viable option.

This is were "meta" information comes into its own.

This package provides the means to associate any kind of data to a model, from ints, float, bools, arrays, to Collections and objects.

Not only does it make it easy to assign this data, it also formats the data for the database and on return usage.

For example a User may need multiple social links, with this package you can create a collection with the data, save right there and then as a Collection (which gets saved as json encoded string).
Then whenever its retrieved in the future it will be converted back to a Collection.

The "meta" is saved as related Eloquent models with simple key/value access.

In the background the meta model also saved the values "type" for use when returning.

The package comes with 2 traits which adds all the functionality needed and a few helpers to make managing the information even easier.

The ```Metable``` trait is used to turn an Eloquent model into a meta model and provides all the background logic for formatting the meta value.

Then the main functionality is accessed through the ```HasMeta``` trait.

Here are a few examples (checkout the docs folder for more details information).

```php

class User extends Eloquent{
    use LeeMason\Metable\HasMeta;

    protected $metaModel = 'UserMeta';
}

class UserMeta extends LeeMason\Metable\MetaModel{
    // By extending the MetaModel we dont have to set the $fillable or $casts properties!
    // Or you can just use the trait
}

$user = new User();

// uses Eloquent firstOrNew to either create or fetch/update the field by "key"
$user->addMeta('key', 'value');

// simple wrapper around addMeta for readability
$user->updateMeta('collection', new Collection(['collection', 'items']));

// need to save lots of data? not a problem
$user->fillMeta([
    'meta1' => true,
    'meta2' => 200,
    'meta3' => [1,2,3],
    ....
]);

// deleting is easy too
$user->deleteMeta('meta2');

// this will return a Collection object
$collection = $user->getMeta('collection');

// and of course, the meta data are related models so can be accessed, or set as such too
$user->meta();

//or
$user->meta

//and
$meta = new UserMeta();
$meta->key = 'thekey';
$meta->value = 'some value';
$user->meta()->save($meta);

```