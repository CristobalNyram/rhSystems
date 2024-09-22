(function () {
    'use strict';

    /**
     * Calendario de proyectos
     *
     * @constructor
     */
    window.Calendar = function () {
        this.$el = $('#calendarContainer');
    };

    window.Calendar.prototype = {

        proId: null, // ID del proyecto
        baseUrl: '',
        $el: null, // Elemento que contiene el calendario
        form: null, // Elemento del formulario por fecha
        formByDays: null, // Elemento del formulario por días

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
                    right: 'month,agendaWeek,agendaDay'
                },
                height: this.getAvailableHeight(),
                defaultView: 'agendaWeek',
                events: this.baseUrl + 'calendario/festivos',
                //viewDestroy: this.viewRender.bind(this),
                //eventRender: this.renderEvent.bind(this),
                eventClick: this.onEventClick,
                //dayClick: this.dayClick.bind(this)
            });

            setTimeout(function () {
                this.$el.fullCalendar('changeView', 'basicWeek');
            }.bind(this), 300);

            // Formularios del dialog
            this.form = $('#calendarForm');

            this.form.on('submit', this.handleOnSubmit.bind(this));

            // Inicializar formularios por fecha & días
            this.initForm();
        },

        onEventClick: function (event, jsEvent, view) {

            var $modal = $('#def-modal-event');

            $modal.find('form').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: e.target.action,
                    data: $(e.target).serialize(),
                    method: 'POST',
                    dataType: 'JSON',
                    success: function (res) {
                        $modal.modal('hide');
                        $modal.find('form').off('submit');

                        if (res.status === 'success')
                        {
                            alertify.alert('Felicidades', 'Se eliminó el evento seleccionado.');
                        }
                        else
                        {
                            alertify.error('Lo sentimos pero el evento no fue eliminado.')
                        }
                    }
                })
            });

            var time = event.end !== null ? (event.start.format('h:mm a') + ' - ' + event.end.format('h:mm a')) : 'Todo el día';

            $modal.find('input[name="dfe_id"]').val(event.id);
            $modal.find('.js-event-title').text(event.title);
            $modal.find('.js-event-time').text(time);
            $modal.find('.js-event-date').text(event.start.format('DD/MM/YYYY'));

            $modal.modal('show');
        },

        /**
         * Reiniciar
         */
        destroy: function () {
            this.$el = null;
            this.proId = null;
        },

        handleOnSubmit: function (e) {
            e.preventDefault();

            var $form = $(e.target);
            var $modal = $form.closest('.modal');
            var data = $form.serialize();

            $.ajax({
                url: e.target.action,
                data: data,
                type: 'POST',
                success: function () {
                    // Reset form
                    $form.get(0).reset();

                    // Hide dialog
                    $modal.modal('hide');

                    alertify.alert('Felicidades', 'Se agregaron nuevos días festivos.');
                }
            })
        },

        /**
         * Inicializar formulario por fecha
         */
        initForm: function () {

            var that = this;

            this.form.find('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

                var type = e.target.href.indexOf('date') > 0 ? 1 : (that.form.find('select[name="stype"]').val());

                //
                that.form.find('input[name="type"]').val(type);

                // Validación
                if (type === 1) {
                    that.form.find('input[name="date"]').prop('required', true);
                    that.form.find('select[name="day"]').prop('required', false);
                    that.form.find('select[name="stype"]').prop('required', false);
                } else {
                    that.form.find('input[name="date"]').prop('required', false);
                    that.form.find('select[name="day"]').prop('required', true);
                    that.form.find('select[name="stype"]').prop('required', true);
                }
            });

            // Daterangepicker plugin
            this.form.find('.js-calendar').daterangepicker({
                singleDatePicker: true,
                maxDate: moment().endOf('year'),
                minDate: moment().startOf('year'),
                parentEl: this.form.closest('.modal'),
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            // Al elegir => mes o año
            this.form.find('#ofType').on('change', function (e) {

                var selected = parseInt($(this).val());

                // Cambiar principal
                that.form.find('input[name="type"]').val(selected);

                // Mes
                if (selected === 2) {
                    that.form.find('#fdMonths').removeClass('hide');
                    that.form.find('#fdYear').addClass('hide');
                    that.form.find('select[name="month"]').prop('required', true);
                }
                // Año
                else if (selected === 3) {
                    that.form.find('#fdYear').removeClass('hide');
                    that.form.find('#fdMonths').addClass('hide');
                    that.form.find('select[name="month"]').prop('required', false);
                }
                // Ninguno
                else {
                    that.form.find('#fdYear').addClass('hide');
                    that.form.find('#fdMonths').addClass('hide');
                    that.form.find('select[name="month"]').prop('required', false);
                }
            });

            // Timepicker
            this.form.find('.js-hora-input').timepicker({
                'minTime': '6:00am',
                'maxTime': '11:00pm'
            });

            this.form.find('#hourType').on('change', function (e) {

                var selected = parseInt($(this).val());

                if (selected === 1)
                {
                    that.form.find('.js-hora').removeClass('hide');
                    that.form.find('.js-hora-input').prop('required', true);
                }
                else
                {
                    that.form.find('.js-hora').addClass('hide');
                    that.form.find('.js-hora-input').prop('required', false);
                }
            });
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