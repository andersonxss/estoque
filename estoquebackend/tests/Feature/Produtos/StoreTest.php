<?php

namespace Tests\Feature\Produtos;
use App\Produto;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{

    /**@test */
    public function test_it_should_store_in_database(){

        Carbon::setTestNow(now());
         $user = factory(User::class)->create();
         $produto = factory(Produto::class)->make();
      

        $this->actingAs($user)->json('POST', '/api/produtos',$produto->toArray())
        ->assertSuccessful();
        $this->assertDatabaseHas('produtos',[
            'pro_nome'=>$produto->pro_nome,
            'pro_quantidade'=>$produto->pro_quantidade,
            'pro_valor'=>$produto->pro_valor
        ]);
        

    }

    // /**@test */
     public function test_name_field_is_required(){
          $user = factory(User::class)->create();
         $produto = factory(Produto::class)->make(['pro_nome'=>'']);
       
      $this->actingAs($user)
        ->json('POST', '/api/produtos',$produto->toArray())
        ->assertSessionHasNoErrors();
        
     }
  
    
    
    
    
    
    
    



  
}
