$(document).ready(function () {
    <!--Cuando alguien haga click e votar y acepta como parametro un evento -->
    $('.btn-vote').click(function (e){
        <!-- con esto prevenismo el comportamiento del botn -->
        e.preventDefault();

        var form=$('#form-vote');

        var button=$(this);
        <!-- con esto obtengo lA clase mas cercana al boton -->
        var ticket=button.closest('.ticket');
        var id=ticket.data('id');

        var action=form.attr('action').replace(':id', id);
        button.addClass("hidden");

        $.post(action,form.serialize(),function (response) {
           ticket.find('.btn-unvote').removeClass('hidden');


            var voteCount = ticket.find('.votes-count');
            var votes= parseInt(voteCount.text().split('')[0]);
            votes++;

            voteCount.text(votes== 1 ? '1 voto' : votes + 'votos');


        }).fall(function () {
            button.removeClass('hide');

        });
        

    });


    $('.btn-unvote').click(function (e){
        <!-- con esto prevenismo el comportamiento del botn -->
        e.preventDefault();

        var form=$('#form-unvote');

        var button=$(this);
        <!-- con esto obtengo lA clase mas cercana al boton -->
        var ticket=button.closest('.ticket');
        var id=ticket.data('id');

        var action=form.attr('action').replace(':id', id);
        button.addClass("hidden");

        $.post(action,form.serialize(),function (response) {
            ticket.find('.btn-vote').removeClass('hidden');

            var voteCount = ticket.find('.votes-count');
            var votes= parseInt(voteCount.text().split('')[0]);
            votes--;

            voteCount.text(votes== 1 ? '1 voto' : votes + 'votos');


        }).fall(function () {
            button.removeClass('hide');

        });


    })
    
});