<script>
  view_profile = (id) => {
    var url = 'http://127.0.0.1:8000/portal/staff/user/profile/:id';
    url = url.replace(':id', id);
    //    alert (id)
    let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=1500,height=700,left=100,top=100`;
    window.open( url,'User_Profile',params)
  }

  view_student = (id) => {
      var url = '{{ route("student.profile", ":id") }}';
      url = url.replace(':id', id);
      window.open( url,'Student_Profile')
  }
</script>