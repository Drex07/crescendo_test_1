@extends('layouts.app')

@section('content')


@verbatim
<template id="editTemplate">
<div class="row">
    <div class="col-md-8 offset-md-2">
    <h1>Edit Recipe</h1>
    <form>
        <div class="form-group">
            <label for="recipeTitle">Recipe Title:</label>
            <input type="text" class="form-control" id="recipeTitle" value="{{title}}">
        </div>
        <div class="form-group">
            <label for="recipeDescription">Description</label>
            <textarea class="form-control"  rows="3" id="recipeDescription"></textarea>
            <input type="hidden" id="recipeDescriptionHidden" value="{{description}}">
        </div>
        <div class="form-group">
            <img src="http://localhost:3001/{{images.medium}}" class="recipeImage" id="recipeImage">
        </div>
        <div class="form-group">
            <label for="recipeServings">Servings</label>
            <input type="number" class="form-control" id="recipeServings" value="{{servings}}">
        </div>

        <div class="form-group">
            <label for="prepTime">Prep Time (mins.):</label>
            <input type="number" class="form-control" id="prepTime" value="{{prepTime}}">
        </div>

        <div class="form-group">
            <label for="cookTime">Cook Time (mins.):</label>
            <input type="number" class="form-control" id="cookTime" value="{{cookTime}}">
        </div>

        <div class="form-group">
            <label for="ingredients">Ingredients:</label>
            <div id="ingredients">

            </div>
            <div>
                <button type="button" class="btn btn-success" id="addingredients">Add Ingredients</button>
            </div>
        </div>
        <div class="form-group">
            <label for="ingredients">Cooking Direction:</label><br>
            <div id="steps">
            </div>
            <div>
                <button type="button" class="btn btn-success" id="addsteps">Add steps</button>
            </div>
        </div>
        <div class="form-group">
            <center>
                <button type="button" class="btn btn-dark" id="cancelButton">Cancel</button>
                <button type="button" class="btn btn-info" id="editRecipe">Save Changes</button>
                <button type="button" class="btn btn-danger" id="deleteRecipe">Delete Recipe</button>
            </center>
        </div>
    </form>
    </div>
</div>

</template>
<template id="ingredientsTemplate">

    {{#ingredients}}
    <div class="form-group formGroup">
        <div class="row">
            <div class="col-md-11">
                <div class="row">
                    <div class="col-md-4">
                        <label for="ingredientsName">Name:</label>
                        <input type="text" class="form-control ingredientsName" value="{{name}}">
                    </div>
                    <div class="col-md-4">
                        <label for="ingredientsAmount">Amount:</label>
                        <input type="number" class="form-control ingredientsAmount" value="{{amount}}">
                    </div>
                    <div class="col-md-4">
                        <label for="ingredientsMeasurement">Measurement:</label>
                        <input type="text" class="form-control ingredientsMeasurement" value="{{measurement}}">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger deleteFormGroupButton">X</button>
            </div>
            <div class="col-md-4" style="display: none;">
                <label for="ingredientsID">Ingredients ID:</label>
                <input type="text" class="form-control ingredientsID" value="{{uuid}}">
            </div>
        </div>  
    </div>
    {{/ingredients}}

</template>
<template id="stepsTemplate">
    {{#directions}}
    <div class="formGroup">
        <div class="form-group">
            <div class="row">
                <div class="col-md-11">
                    <label for="stepsInstruction">Instruction:</label>
                    <textarea class="form-control stepsInstruction"  rows="3"></textarea>
                    <input type="hidden" class="form-control stepsInstructionHidden"  value="{{instructions}}">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger deleteFormGroupButton">X</button>
                </div>
            </div>  
        </div>
        <div class="form-check">
            <div class="row">
                <div class="col-md-4">
                    {{#optional}}
                    <input type="checkbox" class="form-check-input stepsOptional"checked>
                    {{/optional}}
                    {{^optional}}
                    <input type="checkbox" class="form-check-input stepsOptional">
                    {{/optional}}
                    <label for="stepsOptional">Optional</label>
                </div>
            </div>  
        </div>
    </div>
    
    {{/directions}}
</template>


<template id="ingredientsTemplate2">
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
            <div class="col-md-4" style="display: none;">
                <label for="ingredientsID">Ingredients ID:</label>
                <input type="text" class="form-control ingredientsID" value="">
            </div>
        </div>  
    </div>
</template>

<template id="stepsTemplate2">
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
@endverbatim

<div id="editForm">

</div>


<script>

    var $UUID = "{{($uuid)}}";
    var $editForm = $('#editForm');
    var $ingredients = $('#ingredients');
    var $directions = $('#directions');
    var editTemplate = $("#editTemplate").html();
    var $recipeImage = $(".recipeImage");

    $(function(){

        $.ajax({
            type: 'GET',
            url: 'http://localhost:3001/recipes/'+$UUID,
            success: function(recipeToEdit){

                $editForm.append(Mustache.render(editTemplate, recipeToEdit));
            }
        });

    });

    function uuidv4() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }

    setTimeout(function(){ 

        $('#cancelButton').on("click", function(){
            window.location.href = '/recipe/'+$UUID;
        });

        //SET DESCRIPTION VALUE
        $('#recipeDescription').val($('#recipeDescriptionHidden').val());

        //SET INGREDIENTS AND STEPS
        setIngredientAndStepsValue();

        //SET DELETE INGREDIENT AND STEPS BUTTON FUNCTION
        $editForm.delegate('.deleteFormGroupButton', 'click', function(){
            var $ingredientFormGroup = $(this).closest(".formGroup");
            $ingredientFormGroup.remove();
        });

        // ADD ingredients and ADD steps VARIABLES
        var ingredientsTemplate2 = $('#ingredientsTemplate2').html();
        var $ingredients = $('#ingredients');
        var stepsTemplate2 = $('#stepsTemplate2').html();
        var $steps = $('#steps');

        $editForm.delegate("#addingredients", 'click', function(){
            $ingredients.append(ingredientsTemplate2);
        });

        $editForm.delegate("#addsteps", 'click', function(){
            $steps.append(stepsTemplate2);
            
        });

        //SET EDIT BUTTON FUNCTION
        $('#editRecipe').on("click", function(){

            //ADD RECIPE VARIABLES
            var $recipeTitle = $('#recipeTitle');
            var $recipeDescription = $('#recipeDescription');
            var $recipeServings = $('#recipeServings');
            var $prepTime = $('#prepTime');
            var $cookTime = $('#cookTime'); 

            var $ingredientsArray = new Array();
            var $ingredientsName = $('.ingredientsName');
            var $ingredientsAmount = $('.ingredientsAmount');
            var $ingredientsMeasurement = $('.ingredientsMeasurement');
            var $ingredientsID = $('.ingredientsID');

            var $stepsArray = new Array();
            var $stepsInstruction = $('.stepsInstruction');
            var $stepsOptional = $('.stepsOptional');

            for (i = 0; i < $ingredientsName.length; i++) {

                if($ingredientsID[i].value == ""){
                    $ingredientsID[i].value = uuidv4();
                }
                
                var ingredientsObject = {
                    name: $ingredientsName[i].value,
                    amount: $ingredientsAmount[i].value,
                    measurement: $ingredientsMeasurement[i].value,
                    uuid: $ingredientsID[i].value,
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

            var order = {
                title: $recipeTitle.val(),
                description: $recipeDescription.val(),
                servings: $recipeServings.val(),
                prepTime: $prepTime.val(),
                cookTime: $cookTime.val(),
                postDate: (new Date()).toLocaleDateString(),
                editDate: (new Date()).toLocaleDateString(),
                images:{
                    medium:$('#recipeImage').attr('src').replace('http://localhost:3001',''),
                },
                ingredients: $ingredientsArray,
                directions: $stepsArray,
            };

            $.ajax({
                type: 'PATCH',
                url: 'http://localhost:3001/recipes/'+$UUID,
                data: JSON.stringify(order) ,
                dataType: "json",
                contentType: "application/json",
                success: function(editRecipe){
                    alert("Recipe Edited");
                    setTimeout(function(){ 
                        window.location.href = '/recipe/'+$UUID;
                    }, 500);
                   
                },
                error: function(){
                    console.log("Error Edit");
                }
            });

        });

        

        $('#deleteRecipe').on("click", function(){
            $.ajax({
                type: 'DELETE',
                url: 'http://localhost:3001/recipes/'+$UUID,
                success: function(editRecipe){
                    alert("Recipe Deleted");
                    window.location.href = '/recipes';
                },
                error: function(){
                    alert("Error Delete");
                }
            });
        });

        
    }, 500);

    function setIngredientAndStepsValue(){

        var $UUID = "{{($uuid)}}";

        var $ingredients = $('#ingredients');
        var ingredientsTemplate = $("#ingredientsTemplate").html();

        var $steps = $('#steps');
        var stepsTemplate = $("#stepsTemplate").html();

        $.ajax({
            type: 'GET',
            url: 'http://localhost:3001/recipes/'+$UUID,
            success: function(recipeToEdit){

                $ingredients.append(Mustache.render(ingredientsTemplate, recipeToEdit));
                $steps.append(Mustache.render(stepsTemplate, recipeToEdit));

            }
        });

        setStepsValue();

    }

    function setStepsValue(){
        setTimeout(function(){ 

            var $stepsInstructionHidden = $('.stepsInstructionHidden');
            var $stepsInstruction = $('.stepsInstruction');

            for (i = 0; i < $stepsInstructionHidden.length; i++) {
                $stepsInstruction[i].value = $stepsInstructionHidden[i].value;
            }

        }, 500);
    }
</script>
@endsection