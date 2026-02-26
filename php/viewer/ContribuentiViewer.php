<?php

namespace viewer;

class ContribuentiViewer
{
    public function render() : String {
        $html = '<div id = response>';
        $html .= '<label for="contribuenti">Contribuenti:</label>';
        $html .= '<ul id="contribuenti">';
        $contribuenti = json_decode(file_get_contents("php://input"));
        foreach ($contribuenti as $contribuente) {
            $html .= '<li>' . $contribuente->con_nome . '</li>';
        }

        $html .= '</ul></div>';
        return $html;
    }
}

$viewer = new ContribuentiViewer();
echo $viewer->render();