function popup(url, genre)
{
	var width = 650; // default poetry
	if(genre == 2 || genre == 3) // prose or drama
		width = 850; 

	window.open(url, 'creature', 'directories=no,height=750,width=' +width+ ',left=50,top=50,location=yes,resizable=yes,titlebar=yes,status=yes,scrollbars=yes');
}

function confirmDelete()
{
  return confirm('Вы уверены, что хотите удалить данное произведение?');
}