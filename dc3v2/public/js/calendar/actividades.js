(function () {
    'use strict';

    /**
     * Calendario de actividades
     *
     * @constructor
     */
    window.Calendar = function () {
        this.$el = $('#calendarContainer');
    };

    window.Calendar.prototype = {

        proId: null, // ID del actividad
        baseUrl: '',
        $el: null, // Elemento que contiene el calendario

        /**
         * Mostrar el calendario
         */
        init: function() {

            // Inicializar full Calendar
            this.$el.fullCalendar({
                lang: 'es',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                height: this.getAvailableHeight(),
                defaultView: 'basicWeek',
                events: this.baseUrl + 'calendario/actividades?pro_id=' + this.proId,
                //viewDestroy: this.viewRender.bind(this),
                //eventRender: this.renderEvent,
                eventClick: this.onEventClick
                //dayClick: this.dayClick.bind(this)
            });

            setTimeout(function () {
                this.$el.fullCalendar('changeView', 'basicWeek');
            }.bind(this), 300);
        },
        
        renderEvent: function (event, element, view) {
            // Agregar info al evento
        },

        onEventClick: function (event, jsEvent, view) {
            // Reaccionar un click en un evento
        },

        /**
         * Reiniciar
         */
        destroy: function () {
            this.$el = null;
            this.proId = null;
        },

        getAvailableHeight: function() {
            var body = document.body,
                html = document.documentElement;

            var height = Math.min( body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight, window.innerHeight );

            height = height < 400 ? 400 : height;

            // Reducir en base al diseño web
            height -= 86; // .nav_menu
            height -= 51; // .chat-top & chat-search
            height -= 45; // <footer>
            height -= 16; // <== no se de donde viene

            return height;
        }
    };
})();