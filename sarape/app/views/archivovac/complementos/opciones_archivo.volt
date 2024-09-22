{{ link_to("archivovac/descargar/"~reg.arv_id, '<i class="mdi mdi-download mdi-18px btn-icon"></i>', "class": "","title":"Descargar", 'target':'_blank') }}
		                	
<a data-toggle="modal" title="Leer archivo vac" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#leerarchivo_vac-modal" onclick="leerarchivoVac('{{reg.arv_id}}','{{reg.arv_nombre}}','archivosvac','{{reg.vac_id}}')">
    <i class="mdi mdi-eye mdi-18px btn-icon"></i>
</a>
<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fneliminararchivoVac('{{reg.arv_id}}','{{ reg.vac_id }}','general')">
    <i class="mdi mdi-delete mdi-18px btn-icon"></i>
</a>