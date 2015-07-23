function validate(ecs_or_sps) {
  var ku_id = document.getElementById('input-ku_id');
  var localpart = document.getElementById('input-localpart');
  var submit = document.getElementById('input-submit');
  var ku_id_pattern, localpart_pattern;
  var isKuIdValid, isLocalpartValid, isValid;

  if (ecs_or_sps == 'ecs'){
	ku_id_pattern = new RegExp(/^a0[0-9]{6}$/);
	localpart_pattern = new RegExp(/^[a-z]+\.[a-z]+\.[a-z0-9]{3}$/);
  }else{ /* suppose sps */
	ku_id_pattern = new RegExp(/^[a-z]+[0-9]{3}[a-z]+$/);
	localpart_pattern = new RegExp(/^[a-z]+\.[a-z]+\.[a-z0-9]{2}$/);
  }
  
  if (ku_id.value.match(ku_id_pattern)) {
    ku_id.style.backgroundColor = '#cfc';
    ku_id.style.borderColor = '#8f8';
    ku_id.style.color = '#666';
    isKuIdValid = true;
  } else {
    if (ku_id.value === '') {
      ku_id.style.backgroundColor = '#fff';
      ku_id.style.borderColor = '#ddd';
      ku_id.style.color = '#666';
    } else {
      ku_id.style.backgroundColor = '#fcc';
      ku_id.style.borderColor = '#f88';
      ku_id.style.color = '#d00';
    }
    isKuIdValid = false;
  }

  if (localpart.value.match(localpart_pattern)) {
    localpart.style.backgroundColor = '#cfc';
    localpart.style.borderColor = '#8f8';
    localpart.style.color = '#666';
    isLocalpartValid = true;
  } else {
    if (localpart.value === '') {
      localpart.style.backgroundColor = '#fff';
      localpart.style.borderColor = '#ddd';
      localpart.style.color = '#666';
    } else {
      localpart.style.backgroundColor = '#fcc';
      localpart.style.borderColor = '#f88';
      localpart.style.color = '#d00';
    }
    isLocalpartValid = false;
  }

  isValid = isKuIdValid && isLocalpartValid;
  if(isValid && submit.attributes.disabled){
	submit.removeAttribute('disabled')
  }
  if(!isValid && !submit.attributes.disabled){
	  submit.setAttribute('disabled', 'disabled')
  }
}
