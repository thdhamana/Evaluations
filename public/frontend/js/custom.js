$(document).ready(function() {
    $('.counter').each(function() {
        var $this = $(this);
        var countTo = $this.text();

        $({ countNum: $this.text() }).animate({
            countNum: countTo
        },

        {
            duration: 2000, // Durée de l'animation en millisecondes
            easing: 'linear', // Type d'animation
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
                $this.text(this.countNum);
            }
        });
    });
});
