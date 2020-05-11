@extends('layouts.app')

@section('content')

<template id="ingredientsTemplate">
    <div class="form-group formGroup">
        <div class="row">
            <div class="col-md-11">
                <div class='row'>
                    <div class="col-md-4">
                        <label for="ingredientsName">Name:</label>
                        <input type="text" class="form-control ingredientsName">
                    </div>
                    <div class="col-md-4">
                        <label for="ingredientsAmount">Amount:</label>
                        <input type="number" class="form-control ingredientsAmount">
                    </div>
                    <div class="col-md-4">
                        <label for="ingredientsMeasurement">Measurement:</label>
                        <input type="text" class="form-control ingredientsMeasurement">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger deleteFormGroupButton">X</button>
            </div>
        </div>  
    </div>
</template>

<template id="stepsTemplate">
    <div class="formGroup">
        <div class="form-group">
            <div class="row">
                <div class="col-md-11">
                    <label for="stepsInstruction">Instruction:</label>
                    <textarea class="form-control stepsInstruction"  rows="3"></textarea>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger deleteFormGroupButton">X</button>
                </div>
            </div>  
        </div>
        <div class="form-check">
            <div class="row">
                <div class="col-md-4">
                    <input type="checkbox" class="form-check-input stepsOptional">
                    <label for="stepsOptional">Optional:</label>
                </div>
            </div>  
        </div>
    </div>
</template>

<div class="row" id="createForm">
    <div class="col-md-8 offset-md-2">
    <h1>Create Recipe</h1>
    <form>
        <div class="form-group">
            <label for="recipeTitle">Recipe Title:</label>
            <input type="text" class="form-control" id="recipeTitle">
        </div>
        <div class="form-group">
            <label for="recipeDescription">Description</label>
            <textarea class="form-control" id="recipeDescription" rows="3"></textarea>
        </div>
        <!-- <div class="form-group">
            <label for="recipeImage">Example file input</label>
            <input type="file" class="form-control-file" id="recipeImage">
        </div> -->
        <div class="form-group">
            <label for="recipeServings">Servings</label>
            <select class="form-control" id="recipeServings">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>

        <div class="form-group">
            <label for="prepTime">Prep Time (mins.):</label>
            <input type="number" class="form-control" id="prepTime">
        </div>

        <div class="form-group">
            <label for="cookTime">Cook Time (mins.):</label>
            <input type="number" class="form-control" id="cookTime">
        </div>

        <div class="form-group">
            <label for="ingredients">Ingredients:</label>
            <div id="ingredients">
            </div>
            <div>
                <button type="button" class="btn btn-info" id="addingredients">Add Ingredients</button>
            </div>
        </div>
        <div class="form-group">
            <label for="ingredients">Cooking Direction:</label><br>
            <div id="steps">
            </div>
            <div>
                <button type="button" class="btn btn-info" id="addsteps">Add steps</button>
            </div>
        </div>
        <div class="form-group">
            <center>
                <button type="button" class="btn btn-danger" id="addRecipe">Add Recipe</button>
            </center>
        </div>
    </form>
    </div>
</div>
<script>

    $(function(){
        var $createForm = $('#createForm');
        // ADD ingredients and ADD steps VARIABLES
        var ingredientsTemplate = $('#ingredientsTemplate').html();
        var $ingredients = $('#ingredients');
        var stepsTemplate = $('#stepsTemplate').html();
        var $steps = $('#steps');


        //ADD RECIPE VARIABLES
        var $recipeTitle = $('#recipeTitle');
        var $recipeDescription = $('#recipeDescription');
        var $recipeServings = $('#recipeServings');
        var $prepTime = $('#prepTime');
        var $cookTime = $('#cookTime'); 

         //SET DELETE INGREDIENT AND STEPS BUTTON FUNCTION
         $createForm.delegate('.deleteFormGroupButton', 'click', function(){
            var $ingredientFormGroup = $(this).closest(".formGroup");
            $ingredientFormGroup.remove();
        });

        $("#addingredients").on('click', function(){
            $ingredients.append(ingredientsTemplate);
        });

        $("#addsteps").on('click', function(){
            $steps.append(stepsTemplate);
        });

        $('#addRecipe').on('click', function(){

            var $ingredientsArray = new Array();
            var $ingredientsName = $('.ingredientsName');
            var $ingredientsAmount = $('.ingredientsAmount');
            var $ingredientsMeasurement = $('.ingredientsMeasurement');

            var $stepsArray = new Array();
            var $stepsInstruction = $('.stepsInstruction');
            var $stepsOptional = $('.stepsOptional');

            for (i = 0; i < $ingredientsName.length; i++) {
                var ingredientsObject = {
                    name: $ingredientsName[i].value,
                    amount: $ingredientsAmount[i].value,
                    measurement: $ingredientsMeasurement[i].value,
                    uuid: uuidv4(),
                }
                $ingredientsArray.push(ingredientsObject);
            }

            for (i = 0; i < $stepsInstruction.length; i++) {
                var stepsObject = {
                    instructions: $stepsInstruction[i].value,
                    optional: $stepsOptional[i].checked,
                }
                $stepsArray.push(stepsObject);
            }

            console.log($ingredientsArray);
            
            var order = {
                uuid: uuidv4(),
                title: $recipeTitle.val(),
                description: $recipeDescription.val(),
                servings: $recipeServings.val(),
                prepTime: $prepTime.val(),
                cookTime: $cookTime.val(),
                postDate: (new Date()).toLocaleDateString(),
                editDate: (new Date()).toLocaleDateString(),
                images:{
                    medium:"/img/imagePlaceholder.png",
                },
                ingredients: $ingredientsArray,
                directions: $stepsArray,
            };

            $.ajax({
                type: 'POST',
                url: 'http://localhost:3001/recipes',
                data: JSON.stringify(order) ,
                dataType: "json",
                contentType: "application/json",
                success: function(newRecipe){
                    alert("Recipe Added");
                    window.location.href = '/recipes';
                },
                error: function(){
                    alert("Error Adding Recipe");
                }
            });
        });

        function uuidv4() {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }

    });
    
</script>

@endsection