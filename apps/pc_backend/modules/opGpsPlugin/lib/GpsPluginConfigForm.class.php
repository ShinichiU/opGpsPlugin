<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * GpsPluginConfigForm form.
 *
 * @package    OpenPNE
 * @subpackage form
 * @author     Shinichi Urabe <urabe@tejimaya.com>
 */
class GpsPluginConfigForm extends sfForm
{
  protected $configs = array(
    'google_maps_api_key'        => 'op_gps_plugin_api_key',
    'google_ajax_search_api_key' => 'op_gps_plugin_search_api_key',
  );

  public function configure()
  {
    foreach ($this->configs as $k => $v)
    {
      $this->widgetSchema[$k] = new sfWidgetFormInput();
      $this->validatorSchema[$k] = new sfValidatorString();
      $config = Doctrine::getTable('SnsConfig')->retrieveByName($v);
      if ($config)
      {
        $this->getWidgetSchema()->setDefault($k, $config->getValue());
      }
    }

    $this->getWidgetSchema()->setNameFormat('api_config[%s]');
  }

  public function save()
  {
    foreach ($this->getValues() as $k => $v)
    {
      if (!isset($this->configs[$k]))
      {
        continue;
      }

      $config = Doctrine::getTable('SnsConfig')->retrieveByName($this->configs[$k]);
      if (!$config)
      {
        $config = new SnsConfig();
        $config->setName($this->configs[$k]);
      }
      $config->setValue($v);
      $config->save();
    }
  }
}
