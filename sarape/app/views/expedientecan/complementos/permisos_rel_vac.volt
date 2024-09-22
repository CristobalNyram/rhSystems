{% set siete= acceso.verificar(7,rol_id) %}
{% set diez= acceso.verificar(10,rol_id) %}
{% set quince= acceso.verificar(15,rol_id) %}
{% set veintisiete= acceso.verificar(27,rol_id) %}
{% set veintiocho= acceso.verificar(28,rol_id) %}
{% set cuarentayocho= acceso.verificar(48,rol_id) %}
{% set cincuentaycinco= acceso.verificar(55,rol_id) %}
{% set cincuentaysiete= acceso.verificar(57,rol_id) %}
{% set ochentaytres= acceso.verificar(83,rol_id) %}
{% set noventaydos= acceso.verificar(92,rol_id) %}
{% set noventaycinco= acceso.verificar(95,rol_id) %}
{% set sesentaycuatro= acceso.verificar(64,rol_id) %}



{% set estatusValidosExc_para_cambiar_estatus_exc = [1,2,3] %}
{% set estatusValidosVac_para_cambiar_estatus_exc = [2,4,5] %}

{# estos son valores de estatus que no pasaron el proceso  #}
{% set estatusValidosExc_para_reactivar_exc = [11,12,13,14,21,31,41,42,43] %}
{% set estatusValidosVac_para_reactivar_exc = [2,4,5] %}


