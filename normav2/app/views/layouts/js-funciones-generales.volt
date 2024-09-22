<script>

function handleInput(e) {
var ss = e.target.selectionStart;
var se = e.target.selectionEnd;
e.target.value = e.target.value.toUpperCase();
e.target.selectionStart = ss;
e.target.selectionEnd = se;
}

function soloNumeroPositivos(event)
  {
    let ExpRegSoloNumeros="^[0-9]+$";
    if(event.target.value.match(ExpRegSoloNumeros)!=null)
    {
    }
    else
    {
      event.target.value='';
    }

  }
</script>