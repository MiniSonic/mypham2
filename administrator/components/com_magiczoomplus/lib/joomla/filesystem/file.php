<?php

/*------------------------------------------------------------------------
# mod_virtuemart_magiczoomplus - Magic Zoom Plus for Joomla with VirtueMart
# ------------------------------------------------------------------------
# Magic Toolbox
# Copyright 2011 MagicToolbox.com. All Rights Reserved.
# @license - http://www.opensource.org/licenses/artistic-license-2.0  Artistic License 2.0 (GPL compatible)
# Website: http://www.magictoolbox.com/magiczoomplus/modules/virtuemart/
# Technical Support: http://www.magictoolbox.com/contact/
/*-------------------------------------------------------------------------*/

/**
 * @version		$Id: file.php 12541 2009-07-22 17:36:38Z ian $
 * @package		Joomla.Framework
 * @subpackage	FileSystem
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

mz_jimport('joomla.filesystem.path');

/**
 * A File handling class
 *
 * @static
 * @package 	Joomla.Framework
 * @subpackage	FileSystem
 * @since		1.5
 */
class JFile
{
	/**
	 * Gets the extension of a file name
	 *
	 * @param string $file The file name
	 * @return string The file extension
	 * @since 1.5
	 */
	function getExt($file) {
		$dot = strrpos($file, '.') + 1;
		return substr($file, $dot);
	}

	/**
	 * Strips the last extension off a file name
	 *
	 * @param string $file The file name
	 * @return string The file name without the extension
	 * @since 1.5
	 */
	function stripExt($file) {
		return preg_replace('#\.[^.]*$#', '', $file);
	}

	/**
	 * Makes file name safe to use
	 *
	 * @param string $file The name of the file [not full path]
	 * @return string The sanitised string
	 * @since 1.5
	 */
	function makeSafe($file) {
		$regex = array('#(\.){2,}#', '#[^A-Za-z0-9\.\_\- ]#', '#^\.#');
		return preg_replace($regex, '', $file);
	}

	/**
	 * Copies a file
	 *
	 * @param string $src The path to the source file
	 * @param string $dest The path to the destination file
	 * @param string $path An optional base path to prefix to the file names
	 * @return boolean True on success
	 * @since 1.5
	 */
	function copy($src, $dest, $path = null)
	{
		// Prepend a base path if it exists
		if ($path) {
			$src = JPath::clean($path.DS.$src);
			$dest = JPath::clean($path.DS.$dest);
		}

		//Check src path
		if (!is_readable($src)) {
			JError::raiseWarning(21, 'JFile::copy: ' . JText::_('Cannot find or read file') . ": '$src'");
			return false;
		}


        if (!@ copy($src, $dest)) {
            JError::raiseWarning(21, JText::_('Copy failed'));
            return false;
        }
        $ret = true;

		return $ret;
	}

	/**
	 * Delete a file or array of files
	 *
	 * @param mixed $file The file name or an array of file names
	 * @return boolean  True on success
	 * @since 1.5
	 */
	function delete($file)
	{
		// Initialize variables
		if (is_array($file)) {
			$files = $file;
		} else {
			$files[] = $file;
		}

		foreach ($files as $file)
		{
			$file = JPath::clean($file);

			// Try making the file writeable first. If it's read-only, it can't be deleted
			// on Windows, even if the parent folder is writeable
			@chmod($file, 0777);

			// In case of restricted permissions we zap it one way or the other
			// as long as the owner is either the webserver or the ftp
			if (@unlink($file)) {
				// Do nothing
			} else {
				$filename	= basename($file);
				JError::raiseWarning('SOME_ERROR_CODE', JText::_('Delete failed') . ": '$filename'");
				return false;
			}
		}

		return true;
	}

	/**
	 * Moves a file
	 *
	 * @param string $src The path to the source file
	 * @param string $dest The path to the destination file
	 * @param string $path An optional base path to prefix to the file names
	 * @return boolean True on success
	 * @since 1.5
	 */
	function move($src, $dest, $path = '')
	{
		// Initialize variables
		if ($path) {
			$src = JPath::clean($path.DS.$src);
			$dest = JPath::clean($path.DS.$dest);
		}

		//Check src path
		if (!is_readable($src) && !is_writable($src)) {
			JError::raiseWarning(21, 'JFile::move: ' . JText::_('Cannot find, read or write file') . ": '$src'");
			return false;
		}

        if (!@ rename($src, $dest)) {
            JError::raiseWarning(21, JText::_('Rename failed'));
            return false;
        }

		return true;
	}

	/**
	 * Read the contents of a file
	 *
	 * @param string $filename The full file path
	 * @param boolean $incpath Use include path
	 * @param int $amount Amount of file to read
	 * @param int $chunksize Size of chunks to read
	 * @param int $offset Offset of the file
	 * @return mixed Returns file contents or boolean False if failed
	 * @since 1.5
	 */
	function read($filename, $incpath = false, $amount = 0, $chunksize = 8192, $offset = 0)
	{
		// Initialize variables
		$data = null;
		if($amount && $chunksize > $amount) { $chunksize = $amount; }
		if (false === $fh = fopen($filename, 'rb', $incpath)) {
			JError::raiseWarning(21, 'JFile::read: '.JText::_('Unable to open file') . ": '$filename'");
			return false;
		}
		clearstatcache();
		if($offset) fseek($fh, $offset);
		if ($fsize = @ filesize($filename)) {
			if($amount && $fsize > $amount) {
				$data = fread($fh, $amount);
			} else {
				$data = fread($fh, $fsize);
			}
		} else {
			$data = '';
			$x = 0;
			// While its:
			// 1: Not the end of the file AND
			// 2a: No Max Amount set OR
			// 2b: The length of the data is less than the max amount we want
			while (!feof($fh) && (!$amount || strlen($data) < $amount)) {
				$data .= fread($fh, $chunksize);
			}
		}
		fclose($fh);

		return $data;
	}

	/**
	 * Write contents to a file
	 *
	 * @param string $file The full file path
	 * @param string $buffer The buffer to write
	 * @return boolean True on success
	 * @since 1.5
	 */
	function write($file, $buffer)
	{
		// Initialize variables
		
		// If the destination directory doesn't exist we need to create it
		if (!file_exists(dirname($file))) {
			mz_jimport('joomla.filesystem.folder');
			JFolder::create(dirname($file));
		}

		
        $file = JPath::clean($file);
        $ret = file_put_contents($file, $buffer);
		
		return $ret;
	}

	/**
	 * Moves an uploaded file to a destination folder
	 *
	 * @param string $src The name of the php (temporary) uploaded file
	 * @param string $dest The path (including filename) to move the uploaded file to
	 * @return boolean True on success
	 * @since 1.5
	 */
	function upload($src, $dest)
	{
		// Initialize variables
		$ret		= false;

		// Ensure that the path is valid and clean
		$dest = JPath::clean($dest);

		// Create the destination directory if it does not exist
		$baseDir = dirname($dest);
		if (!file_exists($baseDir)) {
			mz_jimport('joomla.filesystem.folder');
			JFolder::create($baseDir);
		}


        if (is_writeable($baseDir) && move_uploaded_file($src, $dest)) { // Short circuit to prevent file permission errors
            if (JPath::setPermissions($dest)) {
                $ret = true;
            } else {
                JError::raiseWarning(21, JText::_('WARNFS_ERR01'));
            }
        } else {
            JError::raiseWarning(21, JText::_('WARNFS_ERR02'));
        }
		return $ret;
	}

	/**
	 * Wrapper for the standard file_exists function
	 *
	 * @param string $file File path
	 * @return boolean True if path is a file
	 * @since 1.5
	 */
	function exists($file)
	{
		return is_file(JPath::clean($file));
	}

	/**
	 * Returns the name, sans any path
	 *
	 * param string $file File path
	 * @return string filename
	 * @since 1.5
	 */
	function getName($file) {
		$slash = strrpos($file, DS);
		if ($slash !== false) {
			return substr($file, $slash + 1);
		} else {
			return $file;
		}
	}
}
