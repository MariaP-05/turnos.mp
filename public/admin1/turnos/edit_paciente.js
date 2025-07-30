if (!turnos) {
    var turnos = {};
}

turnos = { 
    addPaciente: function () {
      $(".paciente-select").hide();
      $(".paciente_section").show();
    },
    deletePaciente: function () {
      $("#nombre_paciente").val('');
      $(".paciente_section").hide();
      $(".paciente-select").show();
    },

    init: function () {
        $(".btn-add-paciente").on("click", this.addPaciente);
        $(".btn-delete-paciente").on("click", this.deletePaciente);
        $(".paciente_section").hide();
    },
};

$(function () {
    "use strict";
    turnos.init();
});
