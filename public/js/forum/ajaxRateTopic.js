$(function() {
  /*click for rate the topic on page of one subject*/
  $('#rateTopic').on("click", function() {
     if(confirm("Are you sure ? You can vote only one time.")) {
      var optionRate = $('select[name="rate"] option:selected').val();
      unsetAlreadyVoted();
      $.post({
        data: {option : optionRate},
        url: 'controller/forum/topic/verifRateTopic.php',
        dataType: 'json',
        timeout: 5000,
        success: function(data) {
          //$('#respondRate').empty();
          addNewRateValue(data);
        },
        error: function() {
          console.log('The request of rate topic did not succed');
          alert(data);
        }
      });
    }
  });
});

function unsetAlreadyVoted() {
  if($('#alreadyVoted')) {
    $("#alreadyVoted").remove();
  }
}

function addNewRateValue(getJson) {
  var newDiv = document.createElement('div');
  var totalRate = null;

  if(getJson.error){
    
    $(newDiv).addClass('text-danger').css("font-size", "0.8em").attr('id', 'alreadyVoted');
    $(newDiv).append(getJson.error);
    $('#respondRate').append(newDiv);
  } else {
    totalRate = 'Total rate : ' + getJson.rate +'/5';
    $(newDiv).append(totalRate);
    $('#respondRate').empty();
    $('#respondRate').append(newDiv);
  }
}

