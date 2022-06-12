<table class='table'>
    <thead>
        <tr>
            <th>Rut</th>
            <th>Nombre</th>
            <th>Proveedor</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contactos as $contacto)
        <tr>
            <td>{{$contacto->rut_contacto}}</td>
            <td>{{$contacto->nombres}} {{$contacto->apellido_paterno}} {{$contacto->apellido_materno}}</td>
            <td>{{$contacto->nombre_fantasia}}</td>
            <td>
            @if($swContacto!=="1" && $_SESSION["role"] == 11)
            <img id='edit_{{$contacto->id_contacto}}'
             class='btnEdit' 
            data-id='{{$contacto->id_contacto}}' 
            data-nombres='{{$contacto->nombres}}' 
            data-apellido_paterno='{{$contacto->apellido_paterno}}' 
            data-apellido_materno='{{$contacto->apellido_materno}}' 
            data-provincia_id='{{$contacto->provincia_id}}' 
            data-rut_contacto='{{$contacto->rut_contacto}}' 
            data-id_cargo='{{$contacto->id_cargo}}' 
            data-id_proveedor='{{$contacto->id_proveedor}}' 
            data-contacto1='{{$contacto->contacto1}}' 
            data-contacto2='{{$contacto->contacto2}}'
            data-contacto3='{{$contacto->contacto3}}'
            data-email1='{{$contacto->email1}}'
            data-email2='{{$contacto->email2}}'
            data-direccion='{{$contacto->direccion}}'
            width='15px'  heigth='15px' src="{{asset('../resources/icons/001-editar.png')}}" /> 
            @endif

            @php
               $cheked="";
            @endphp  

            @if($contacto->id_empresa =="1") 
                @php
                 $cheked="checked";
                @endphp               
            @endif 

            @if($swContacto=="1")
                  <div class="form-check">
                    <input class="form-check-input selContacto" 
                    data-id='{{$contacto->id_contacto}}'  
                   {{$cheked}} 
                    type="radio" name="selContacto" >

                        <label class="form-check-label" for="flexRadioDefault1">
                            Seleccionar
                        </label>
                    </div>
                  @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>