function init(){
    loadIngred()
    loadRecipes()
}
var ingred = -1;
var q = "";
function loadIngred() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ingred").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "loader.php?type=ingredientsList", true);
    xmlhttp.send();
}
function reloadRecipes(o){
    q = o.value;
    loadRecipes()
}
function setIngred(o) {
    local = o.id.replace('i','')
    if(ingred!==-1){
        document.getElementById('i'+ingred).classList.remove("active");
    }
    if(local===ingred){
        ingred = -1;
    }
    else{
        ingred = local;
        o.classList.add("active")
    }
    loadRecipes()

}
function loadRecipes(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("recipesList").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "loader.php?type=recipesList&ingred="+ingred+"&q="+q, true);
    xmlhttp.send();
}
function loadRecipe(o){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var obj = document.getElementById("frame");
            obj.innerHTML = this.responseText;
            obj.style.display="flex";

        }
    };
    xmlhttp.open("GET", "loader.php?type=recipe&recipe="+o.id, true);
    xmlhttp.send();
}