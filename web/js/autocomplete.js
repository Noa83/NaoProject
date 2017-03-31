var species = $("#birds_names").val().split(",");


$( "#observation_specie" ).autocomplete({
    source: species,
    minLenght: 1
});

