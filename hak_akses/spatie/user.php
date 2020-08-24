  <?php
  public function up()
    {
        Schema::create('users', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('foto')->nullable();
            $table->string('password');
            $table->boolean('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }
