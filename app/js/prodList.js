var i = 0;
function add(){
    if(i!==0){
        document.getElementById("formLst").value += ","
        document.getElementById("lista").innerText += ", "
    }
    for(var x = 0; x < listaIndeks.length; x++){
        if(listaIndeks[x]==document.getElementById("lst").value){
            document.getElementById("formLst").value += document.getElementById("lst").value
            document.getElementById("lista").innerText += listaNazw[x]
        }
    }
    i++;
}