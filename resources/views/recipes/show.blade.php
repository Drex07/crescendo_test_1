@extends('layouts.app')

@section('content')

<div id="orders">

</div>

@verbatim
<template id="orderTemplate">
    <div class="row">
        <div class="col-md-6 offset-md-3" class="recipeDiv" style="text-align: center;">
            <h1>{{title}}</h1><br>
            <div><img src="http://localhost:3001/{{images.medium}}" class="recipeImage"></div>
            <br>
            <p>{{description}}</p>
            <a href="/recipe/edit/{{uuid}}"><button type="button" class="btn btn-success">EDIT RECIPE</button></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <p>Servings: {{servings}}</p>
            <p>Prep Time: {{prepTime}} mins.</p>
            <p>Cook Time: {{cookTime}} mins.</p>
            <p>Posted on: {{postDate}}</p>
            <p>Edited on: {{editDate}}</p>
            <h1>Ingredients: </h1><br>
            {{#ingredients}}
            <div class="form-check">
                <input type="checkbox" class="form-check-input">
                <label class="form-check-label">{{amount}} {{measurement}} {{name}}</label>
                <div id="{{uuid}}" class="ingredientsSpecial">
                    <!-- <p>test</p>
                    <p>test</p>
                    <p>test</p> -->
                </div>
            </div>
            {{/ingredients}}
            <br>
            <h1>Steps:</h1><br>
            <ol>
                {{#directions}}
                <li>
                    {{instructions}} {{#optional}}(optional){{/optional}}
                </li><br>
                {{/directions}}
            </ol>
        </div>
    </div>
</template>
@endverbatim

<!-- <input type="textarea"> -->

</input>
<script>
    $(function(){

        var $UUID = "{{($uuid)}}";
        var $orders = $('#orders');
        var $ingredients = $('#ingredients');
        var $directions = $('#directions');
        var orderTemplate = $("#orderTemplate").html();
        var $recipeImage = $(".recipeImage");

        $.ajax({
            type: 'GET',
            url: 'http://localhost:3001/recipes/'+$UUID,
            success: function(orders){

                $orders.append(Mustache.render(orderTemplate, orders));

                $.ajax({
                    type: 'GET',
                    url: 'http://localhost:3001/specials/',
                    success: function(ingredients){
                        console.log("success specials");
                        for (i = 0; i < orders.ingredients.length; i++) {
                            for (j = 0; j < ingredients.length; j++) {
                                if(orders.ingredients[i].uuid == ingredients[j].ingredientId){
                                    // $("#"+orders.ingredients[i].uuid).text($("#"+orders.ingredients[i].uuid).text() + " (" + ingredients[j].title + ", " + ingredients[j].type + ", " + ingredients[j].text + ")");
                                    // $("#"+orders.ingredients[i].uuid).append('<p>'+ ingredients[j].title +'</p>');
                                    // $("#"+orders.ingredients[i].uuid).append('<p>'+ ingredients[j].type +'</p>');
                                    // $("#"+orders.ingredients[i].uuid).append(ingredients[j].text);

                                    var ingredientsSpecialText = '<p>'+ ingredients[j].title +'</p><p>'+ ingredients[j].type +'</p>' ;
                                    
                                    $("#"+orders.ingredients[i].uuid).append('<div class="' + orders.ingredients[i].uuid + " " + ingredients[j].type + '">' + ingredients[j].title + '</div>')
                                    $("."+orders.ingredients[i].uuid+"."+ingredients[j].type).append(ingredients[j].text);
                                }
                            }
                        }

                    },
                    error: function(){
                        console.log("error specials");
                    }
                });
               
            }
        });

        

        
    });
</script>
@endsection