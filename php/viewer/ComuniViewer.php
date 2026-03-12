<?php

namespace viewer;
header('Content-Type: text/html; charset=utf-8');

class ComuniViewer
{
    public function render() : String {
        $html = '<div id = combo>';
        $html .= '<label for="comuni">Comuni:</label>';
        $html .= '<select id="comuni" name="comuni">';
        $html .= '<option value = "-1">--Seleziona--</option>';
        $comuni = json_decode(file_get_contents("php://input"));
        foreach ($comuni as $comune) {
            $html .= '<option value="'.$comune->com_id.'">' . $comune->com_nome . '</option>';
        }
        $html .= '</select></div>';
        return $html;
    }
}

$viewer = new ComuniViewer();
echo $viewer->render();