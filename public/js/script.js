function switchDisplay(){
    var defaut = document.getElementById('default');
    var hide = document.getElementById('hide');
     
    defaut.style.display = (defaut.style.display == 'none' ? '' : 'none');
    hide.style.display = (hide.style.display == 'none' ? '' : 'none');
}
