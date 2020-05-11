@extends('layouts.app')

@section('content')

<div id="recipes">
</div>

@verbatim
<template id="recipesTemplate1">
    <div class="row">
        <div class="col-md-6 recipeDiv">
            <div><img src="http://localhost:3001/{{images.medium}}" class="recipeImage"></div>
        </div>
        <div class="col-md-6 recipesDescription">
            <h1>{{title}}</h1>
            <p>{{description}}</p>
            <a href="/recipe/{{uuid}}"><button type="button" class="btn btn-success" id="createRecipe">SEE RECIPE</button></a>
        </div>
    </div>
</template>

<template id="recipesTemplate2">
    <div class="row">
        <div class="col-md-6 recipesDescription">
            <h1>{{title}}</h1>
            <p>{{description}}</p>
            <a href="/recipe/{{uuid}}"><button type="button" class="btn btn-success" id="createRecipe">SEE RECIPE</button></a>
        </div>
        <div class="col-md-6 recipeDiv">
            <div><img src="http://localhost:3001/{{images.medium}}" class="recipeImage"></div>
        </div>
    </div>
</template>
@endverbatim
<script>
    $(function(){
        
        var $recipes = $('#recipes');
        var recipesTemplate1 = $("#recipesTemplate1").html();
        var recipesTemplate2 = $("#recipesTemplate2").html();

        $.ajax({
            type: 'GET',
            url: 'http://localhost:3001/recipes',
            success: function(recipes){
                $.each(recipes, function(i, recipe){


                    // console.log("Index? " + i);
                    if(i%2==0){
                        $recipes.append(Mustache.render(recipesTemplate1, recipe));
                    }else{
                        $recipes.append(Mustache.render(recipesTemplate2, recipe));
                    }

                });
            },
            error: function(){
                alert("Error Loading Recipes");
            }
        });
    });
</script>
@endsection




