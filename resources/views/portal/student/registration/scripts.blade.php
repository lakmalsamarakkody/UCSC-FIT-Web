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

  address_editable = () => {
    console.log('hello');
    if(document.getElementById("current_address").checked == true) {
      console.log('disabled');
      $('#currentHouse').removeAttr('disabled');
    }
    else{
      document.getElementById('currentHouse').setAttribute("disabled","disabled");
    }
  }
  
  // /INSERT CURRENT ADDRESS
  </script>