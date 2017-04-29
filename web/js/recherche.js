$(function(){
    $('#recherche_recherche').autocomplete({
        source : function (requete, reponse) { // la fonction anonyme permet de maintenir une requête AJAX directement dans le plugin
            //un qui représentera la requête tapée dans le champ de texte, et un autre qui représentera la réponse renvoyée par AJAX, et donc ma liste de suggestions.
            var objData = {};
            objData = { nomVern: requete.term };
            console.log(objData);
            $.ajax({
                url : "{{ path('ajax') }}", //On appelle le script JSON
                dataType : 'json', //On spécifie bien que le type de donnée est en JSON
                data : objData,
                type: "POST",
                success : function(data){  // on se prépare à renvoyer les données réceptionnées grâce à l'évènement de succès
                    //console.log(data);
                    reponse($.map(data, function(objet){
                        //var objet[] = objet.title + objet.nomVern;
                        console.log(objet);
                        if(objet.title == null)
                        {
                            return objet.nomVern;
                        }
                        if(objet.nomVern == null)
                        {
                            return objet.title;
                        }
                        //return objet.nomVern;// on retourne cette forme de suggestion
                    }))
                },
                error: function() { // if error
                    alert('problème');
                }
            });
        }
    });
});