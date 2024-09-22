{% for est in page %}
		{% if loop.first %}
			<select class='form-control' name="est_id" id="est_id">			
		{% endif %}
			<option value="{{est.est_id}}">{{est.est_nombre}}</option>
			{% if loop.last %}
				</select>
			{% endif %}
		{% else %}
	    No existen registros en este catálogo relacionados al país.
{% endfor %}

