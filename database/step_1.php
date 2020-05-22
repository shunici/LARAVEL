<?php 

///////////satu ke banyak ////////////
// langkah 1
php artisan make:model Category -m


public function up()
{
    Schema::create('categories', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('description')->nullable();
        $table->timestamps();
    });
}

//langkah 2
php artisan make:model product -m


public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('description')->nullable();
        $table->string('stock');
        $table->string('price');
        $table->integer('category_id');
        $table->timestamps();
    });
}

//langkah 3 relasi data dari produk ke kategori
php artisan make:migration add_relationships_to_products_table


public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->integer('category_id')->unsigned()->change();
        $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('products', function(Blueprint $table) {
        $table->dropForeign('products_category_id_foreign');
    });
​
    Schema::table('products', function(Blueprint $table) {
        $table->dropIndex('products_category_id_foreign');
    });
​
    Schema::table('products', function(Blueprint $table) {
        $table->integer('category_id')->change();
    });
}


//catatan penting jika idnya bigInteger maka relasinya bigInteger juga

di model product.php  (app/product.php)
protected $guarded = [];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
  
//terakhir
composer require doctrine/dbal
aktifkan database


contoh dengan bigInteger
      public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->bigInteger('bahan_id')->unsigned()->change();
            $table->foreign('bahan_id')->references('id')->on('bahans')
                ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropForeign('produks_bahan_id_foreign');
            $table->dropIndex('produks_bahan_id_foreign');
            $table->bigInteger('bahan_id')->change();
        });
    }


/>
