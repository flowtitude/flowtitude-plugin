<?php
/**
 * Plugin Name: Flowtitude
 * Plugin URI:  https://flowtitude.com
 * Description: Plugin to create contextual popups with proposed values for Tailwind
 * Version:     0.0.1
 * Author:      Ángel Julián Mena, Miquel Roca Mascarós
 * Author URI:  https://flowtitude.com
 */

if (!defined('ABSPATH')) {
	 exit;
 }
 
class Flowtitude {
 
	 public function __construct() {
		add_action('plugins_loaded', array($this, 'load_textdomain'));
		register_activation_hook(__FILE__, array($this, 'verify_dependencies'));
		register_activation_hook(__FILE__, array($this, 'enable_plugin'));
		register_deactivation_hook(__FILE__, array($this, 'disable_plugin'));
		add_action('init', array($this, 'init_plugin'));
	}
	 
 	public function load_textdomain() {
		  load_plugin_textdomain('flowtitude', false, dirname(plugin_basename(__FILE__)) . '/languages/');
	}
	  
	public function verify_dependencies() {
		$theme = wp_get_theme(); // Obtiene el tema actual
 
		// Comprueba si Bricks Builder o un tema hijo está activo
		if ('bricks' !== strtolower($theme->get('Name')) && 'bricks' !== strtolower($theme->get('Template'))) {
			deactivate_plugins(plugin_basename(__FILE__)); // Desactiva el plugin
			wp_die(__('This plugin requires the Bricks Builder theme or a Bricks Builder child theme to be active.', 'flowtitude'));
		}
 
		// Comprueba si el plugin Yabe SIUL está activo
		include_once(ABSPATH . 'wp-admin/includes/plugin.php');
		if (!is_plugin_active('yabe-siul/yabe-siul.php')) {
			deactivate_plugins(plugin_basename(__FILE__)); // Desactiva el plugin
			wp_die(__('This plugin requires the Yabe SIUL plugin to be installed and active.', 'flowtitude'));
		}
	}
	 
	public function enable_plugin() {
		 // Código para ejecutar al activar el plugin
	}
	 
	public function disable_plugin() {
		 // Código para ejecutar al desactivar el plugin
	}
	 
	public function init_plugin() {
		// Verifica si estamos en el editor de Bricks Builder antes de ejecutar el código personalizado.
		if (function_exists('bricks_is_builder_main') && bricks_is_builder_main()) {
			// Aquí agregas el código que quieres que se ejecute dentro del editor de Bricks.
			$this->init_flowtitude();
		}
	}
	
	public function init_flowtitude() {
		// Aquí implementas la lógica específica que quieres ejecutar en el editor de Bricks.
	}

 }
 
 // Instanciar la clase para ejecutar el plugin.
 new Flowtitude();