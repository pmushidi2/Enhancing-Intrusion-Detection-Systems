function taux_attaque() {
        $data_rapport = get_rapport();
        $nb_total_rapport = count($data_rapport);
        $data_by_type_attaque = array();
        foreach($data_rapport as $rapport) {
            $data_by_type_attaque[$rapport['type_attaque']][] = $rapport; 
        }
        
        $datay=array();
        $data_labels = array();
        $true_labels = array();
        $i = 1;
        foreach($data_by_type_attaque as $type_attaque => $v) {
            $freq = count($v);
            $taux = $freq * 100 / $nb_total_rapport;
            $datay[] = $taux;
            $data_labels[] = 'L'.$i;
            $true_labels['L'.$i] = $type_attaque;
            $i++;
        }        

        $graph = new Graph(350,220,'auto');
        $graph->SetScale("textlin");

        $graph->yaxis->SetTickPositions(array(), array());
        $graph->SetBox(false);

        $graph->ygrid->SetFill(false);
        $graph->xaxis->SetTickLabels($data_labels);
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false,false);

        $b1plot = new BarPlot($datay);

        $graph->Add($b1plot);
        $b1plot->SetColor("white");
        $b1plot->SetFillGradient("#4B0082","white",GRAD_LEFT_REFLECTION);
        $b1plot->SetWidth(45);
        $graph->title->Set("Bar Gradient(Left reflection)");

        // Display the graph
        @unlink('rp.jpg');
        $graph->Stroke('rp.jpg');

        return $true_labels;
    }

    $true_labels = taux_attaque();
    $show_labels = '<p>';
    foreach($true_labels as $code => $label) {
        $show_labels .= '<strong>% '.$code.' : </strong><em>'.$label.'</em><br>';
    }
    $show_labels .= '</p>';
