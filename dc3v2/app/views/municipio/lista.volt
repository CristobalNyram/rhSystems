{% for mun in page %}
		{% if loop.first %}
			<select class='form-control' name="mun_cla" id="mun_cla">			
		{% endif %}
			<option value="{{mun.mun_cla}}">{{mun.mun_nombre}}</option>
			{% if loop.last %}
				</select>
			{% endif %}
		{% else %}
	    No existen registros en este catálogo relacionados al país.
{% endfor %}

