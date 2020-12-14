@section('script')
<script type="text/javascript">
  $(function () {
    alert('asvas');
    $(".collapse.show").each(function(){
    // Add chevron-down icon for collapse element which is open by default
      $(this).prev(".card-header").find(".btn").addClass("btn-show");
      $(this).prev(".card-header").addClass("header-show");
      $(this).prev(".card-header").find(".fa").addClass("fa-chevron-down").removeClass("fa-chevron-right");
    });
    
    // Toggle chevron icon and colors on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function(){
      $(this).prev(".card-header").find(".btn").addClass("btn-show");
      $(this).prev(".card-header").addClass("header-show");
      $(this).prev(".card-header").find(".fa").removeClass("fa-chevron-right").addClass("fa-chevron-down");
    }).on('hide.bs.collapse', function(){
      $(this).prev(".card-header").removeClass("header-show");
      $(this).prev(".card-header").find(".btn").removeClass("btn-show");
      $(this).prev(".card-header").find(".fa").removeClass("fa-chevron-down").addClass("fa-chevron-right");
    });
  });
</script>
@endsection