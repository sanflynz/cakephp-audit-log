<?php

App::uses('AppHelper', 'View/Helper');

class AuditLogHelper extends AppHelper {

	public $helpers = array('Text', 'Html');

	public function getEvent($item) {
		switch (strtolower($item['Audit']['event'])) {
			case 'create'	: return '<span class="label label-success">create</span>';
			case 'edit'		: return '<span class="label label-warning">edit</span>';
			case 'delete'	: return '<span class="label label-danger">delete</span>';
			default 			: return '<span class="label label-default">' . $item['Audit']['event'] . '</span>';
		}
	}

	public function getSourceId($item) {
		return $item['Audit']['source_id'];
	}

	public function getSource($item) {
		return $item['Audit']['source_id'];
	}

	public function outputValue($value) {
		if ($value === NULL) {
			return 'NULL';
		}

		if ($value === '') {
			return '(EMPTY)';
		}

		return h($this->Text->truncate($value, 50));
	}

	public function getIdentifier($item) {
		if (empty($this->_View->viewVars['model'])) {
			$name = $item['Audit']['entity_id'];
		} else {
			$model = $this->_View->viewVars['model'];
			$displayField = $this->_View->viewVars['displayField'];

			$name = $item[$model][$displayField];
		}

		return $this->Text->truncate($name, 50);
	}

	public function getDiff($field, $new, $old) {
		if (preg_match('#[A-Z]#', $field[0])) {
			$new = explode(',', $new);
			$old = explode(',', $old);
		}

		$config = array(
			'ignoreNewLines' => true,
			'ignoreWhitespace' => true,
			'ignoreCase' => true
		);

		$diff = new Diff((array)$old, (array)$new, $config);
		return $diff->render(new Diff_Renderer_Html_SideBySide());
	}

    public function getObjectDetails($json) {
        if ( empty($json) ) {
            return '';
        }
        $object = json_decode($json, true);
        if ( empty($object) ) {
            return '';
        }
        $recursive = function ($list) use (&$recursive) {
            $html = '<ul>';
            foreach ( $list as $key => $value ) {
                if ( is_array($value) ) {
                    $value = $recursive($value);
                }
                $html .= sprintf(
                    '<li><strong>%s</strong>:%s</li>',
                    $key,
                    $value
                );
            }
            $html .= '</ul>';
            return $html;
        };
        return $recursive($object);
    }

}
