<script type="text/javascript">


// INSERT CURRENT ADDRESS
/*
  InputRoleName_editable = () => {
    if($('#InputRoleName').attr('disabled')){
      $('#InputRoleName').removeAttr('disabled');
    }
    else{
      document.getElementById('InputRoleName').setAttribute("disabled","disabled");
    }
  }
  function InputRoleName_readonly() {
    document.getElementById('InputRoleName').setAttribute("disabled","disabled");
  } */

  enter_current_addressss = () => {
    if($('#addrs').attr('checked')){
      $('#currentHouse').removeAttr('disabled');
    }
    else{
      document.getElementById('currentHouse').setAttribute("disabled","disabled");
    }
  }
  function current_address(addrs) {
    document.getElementById("currentHouse").disabled = addrs.checked ? false:true;
    if(!document.getElementById("currentHouse").disabled){
      document.getElementById("currentHouse").focus;
    }
  }
  // /INSERT CURRENT ADDRESS
  </script>