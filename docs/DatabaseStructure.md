## Database Structure

The table structure for the model utilizing the ```HasMeta`` trait is un effected by the meta package and requires no additional columns.

The table structure for the meta model has only a few specific requirements, they are expressed below using the Laravel Schema class:

```php

\Schema::create('thetablename', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('**_id')->unsigned()->index();
    $table->foreign('**_id')->references('id')->on('**')->onDelete('cascade');
    $table->string('key')->index();
    $table->text('type')->nullable();
    $table->text('value')->nullable();
    $table->timestamps();//optional

    //any additional columns required if needed
});

```

** refers to the relation model classname, so a model called Users would become "users" and somthing like "ClassWithMoreWords" would become "class_with_more_words".
