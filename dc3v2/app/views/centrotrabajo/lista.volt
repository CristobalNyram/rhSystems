{% if def!=0 %}
	{% for cen in page %}
		{% if loop.first %}
			<select class='form-control' name="cen_id" id="cen_id">			
		{% endif %}
			{% if cen.cen_id==def %}
				<option selected value="{{cen.cen_id}}">{{cen.cen_ubicacion}}</option>
			{% else %}	
				<option value="{{cen.cen_id}}">{{cen.cen_ubicacion}}</option>
			{% endif %}
			{% if loop.last %}
				</select>
			{% endif %}
		{% else %}
	    	<select class='form-control' name="cen_id" id="cen_id">			
			<option value="0">Sin centro de trabajo</option>
	{% endfor %}
{% else %}
	{% for cen in page %}
		{% if loop.first %}
			<select class='form-control' name="cen_id" id="cen_id">			
		{% endif %}
			<option value="{{cen.cen_id}}">{{cen.cen_ubicacion}}</option>
			{% if loop.last %}
				</select>
			{% endif %}
		{% else %}
	    	<select class='form-control' name="cen_id" id="cen_id">			
			<option value="0">Sin centro de trabajo</option>
	{% endfor %}
{% endif %}
