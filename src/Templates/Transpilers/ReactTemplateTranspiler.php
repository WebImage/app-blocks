<?php

namespace WebImage\BlockManager\src\Templates\Transpilers;

use WebImage\BlockManager\src\Templates\Parsers\Plugins\WrapMacroParser;
use WebImage\BlockManager\src\Templates\Parsers\TemplateParser;
use WebImage\BlockManager\src\Templates\Plugins\AuthorMacro;
use WebImage\BlockManager\src\Templates\Plugins\ControlOptionMacro;
use WebImage\BlockManager\src\Templates\Plugins\DraggableMacro;
use WebImage\BlockManager\src\Templates\Plugins\ExtendBlockMacro;
use WebImage\BlockManager\src\Templates\Plugins\JavascriptVariable;
use WebImage\BlockManager\src\Templates\Plugins\PropertyMacro;
use WebImage\BlockManager\src\Templates\Plugins\ReactCode;
use WebImage\BlockManager\src\Templates\Transpilers\Plugins\ControlMacroTranspiler;
use WebImage\BlockManager\src\Templates\Transpilers\Plugins\IfSupportsMacroGroupTranspiler;
use WebImage\BlockManager\src\Templates\Transpilers\Plugins\MacroGroupTranspiler;
use WebImage\BlockManager\src\Templates\Transpilers\Plugins\ReactBlockMacroTranspiler;
use WebImage\BlockManager\src\Templates\Transpilers\Plugins\ReactControlDefinitionTranspiler;
use WebImage\BlockManager\src\Templates\Transpilers\Plugins\ReactEachMacroTranspiler;
use WebImage\BlockManager\src\Templates\Transpilers\Plugins\ReactHtmlTranspiler;

class ReactTemplateTranspiler extends Transpiler
{
    protected array $supportedFeatures = ['react'];

    public function __construct()
    {
        $this->initPlugins();
    }

	private function initPlugins()
	{
		$this->plugin(new JavascriptVariable());
		$this->plugin(new ReactCode());
		$this->plugin(new MacroGroupTranspiler(TemplateParser::T_MACRO, [
			new ReactBlockMacroTranspiler(),
			new AuthorMacro(),
			new PropertyMacro(),
			new ReactControlDefinitionTranspiler(),
			new ControlMacroTranspiler(),
			new ControlOptionMacro(),
			new IfSupportsMacroGroupTranspiler(),
			new WrapMacroParser(),
			new ReactEachMacroTranspiler(),
			new ExtendBlockMacro(),
			new DraggableMacro(),
		]));

		$this->plugin(new ReactHtmlTranspiler());
	}
}
