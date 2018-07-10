$(function() {
  /*lick to search in nav bar on list of subject*/
  $('#searchNav').on("click",function() { //on("click") it's working for dynamic element(like ajax)
    var inputSearch = $('input[name="search"]').val();
    var optionSearch = $('select[name="fields"] option:selected').val();
    var inputs = $('input').get();
    var input = inputs[0].value;
    $.ajax({
      type: 'POST',
      data: {searchText : inputSearch, searchField : optionSearch},
      url: 'controller/forum/forumSearchListTable.php',
      timeout: 3000,
      success: function(data) {
        $('#tableSubject').empty();
        $(data).appendTo('#tableSubject');
      },
      error: function() {
        console.log('The request did not succeed');
        alert(data);
      }
    });
  });
});