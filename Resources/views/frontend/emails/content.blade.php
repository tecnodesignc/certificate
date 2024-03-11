<tr>
    <td style="font-size:16px; font-family:'Arial',Helvetica,sans-serif, sans-serif; color:#999;">
        <p style="line-height:150%;"><span
                style="font-size:18px;"><span
                    style="color:#33c0c9;"><strong></strong></span></span>
        </p>


        <p style="line-height:150%;">Adjuntamos certificados solicitados</p>

        <p style="line-height:150%;">Si no tiene conocimiento de esta información o de haber solicitado estos certificados favor eliminar este correo.
        </p>
        <p style="line-height:150%;">
        <ul>
            @foreach($data as $index => $field)
                <li>
                    <a href="{{ route('certificate.generate.view',['key'=>$field->key,'id'=>$field->id])}}">{{ route('certificate.generate.view',['key'=>$field->key,'id'=>$field->id])}}</a>
                </li>
            @endforeach
        </ul>
        </p>
    </td>
</tr>
