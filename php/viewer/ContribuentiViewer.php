<?php

namespace viewer;
header('Content-Type: text/html; charset=utf-8');

class ContribuentiViewer
{
    public function render() : String {
        $contribuenti = json_decode(file_get_contents("php://input"));
        $html = '<div id = AjaxResponse>';
        $html .= '<ul id="contribuenti">';
        foreach ($contribuenti as $contribuente) {
            $html .= '<li>' . $contribuente->con_nome . '</li>';
        }

        $html .= '</ul></div>';
        return $html;
    }
}

$viewer = new ContribuentiViewer();
echo $viewer->render();