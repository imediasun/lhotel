<?php

namespace App;


class Cart
{
    //
    public $items=null;
    public $totalQty=0;
    public $totalPrice=0;

    public function  __construct($oldCart)
    {

        if($oldCart){

            $this->items=$oldCart->items;
            $this->totalQty=$oldCart->totalQty;
            $this->totalPrice=$oldCart->totalPrice;

        }
    }
    public function add($item,$id){
    $storedItem=['summ_quantaty'=>0, 'price'=>$item['price'], 'qnt'=>$item['qnt'],  'item'=>$item, 'summ'=>0];

    if($this->items){
        
        if(array_key_exists($id,$this->items)){
            $storedItem=$this->items[$id];

        }
    }

        $storedItem['qnt']=$item['qnt'];
        $storedItem['summ_quantaty']=$storedItem['summ_quantaty']+$storedItem['qnt'];

        $storedItem['price']=$item['price'];
        $storedItem['summ']+=$storedItem['price'] * $storedItem['summ_quantaty'];
        $this->items[$id]=$storedItem;
        $this->totalQty+=$storedItem['qnt'];
        $this->totalPrice +=$item['price'] * $storedItem['qnt'] ;

    }

    public function delete_by_one($item,$id){

        $storedItem['qnt']=$item['qnt'];
        $storedItem['price']=$item['price'];
        $storedItem['summ_quantaty']=$item['summ_quantaty']-1;
        if($storedItem['summ_quantaty']==0){
        unset($this->items[$id] );

        }
        else{
        $storedItem['item']=$item['item'];
        $this->items[$id]=$storedItem;
        }

        $this->totalQty-=1;
        $this->totalPrice -=$storedItem['price'];
   
        /*dd($this);*/


    }

    public function delete_all($item,$id){


//установить общее количество продукта
        $storedItem['qnt']=$item['qnt'];
        $storedItem['price']=$item['price'];
        $storedItem['summ_quantaty']=$item['summ_quantaty'];
        $this->totalQty-=$item['summ_quantaty'];
        $this->totalPrice -=$storedItem['price']*$storedItem['summ_quantaty'];
        unset($this->items[$id] );


        /*dd($this);*/


    }
}
