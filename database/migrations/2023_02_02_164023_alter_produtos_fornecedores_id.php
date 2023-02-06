<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProdutosFornecedoresId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /// insert para nao dar erro 
        Schema::table('produtos',function (Blueprint $table ) {


            $fornecer_id = DB::table('fornecedores')->insertGetid([
                'nome' => 'Fornecedor Padrão',
                'site' => 'www.fornecedorpadrao.com.br',
                'uf' => 'PR',
                'email' => 'contato_forncedor@padrao.com.br'
            ]);

            $table->unsignedBigInteger('fornecedor_id')->default($fornecer_id)->after('id');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void 
     */
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign('produtos_fornecedor_id_foreign');
            $table->dropColumn('fornecedor_id');
         });
    }
}
