<?php
namespace Softlogo\CMSBundle\Extension;

class MailHelper
{
	protected $mailer;
	protected $twig;
	
	public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
	{
		$this->mailer = $mailer;
		$this->twig = $twig;
	}

	public function sendEmail($from, $to, $subject, $body)
	{
		$message = \Swift_Message::newInstance()
			->setContentType('text/html')
			->setSubject($subject)
			->setFrom($from)
			->setTo($to)
			->setBody($body)
		;
		$this->mailer->send($message);
	}

	public function sendEmailWithView($from, $to, $subject, $view, $parameters)
	{
		$body = $this->twig->render($view, $parameters);
		$message = \Swift_Message::newInstance()
			->setContentType('text/html')
			->setSubject($subject)
			->setFrom($from)
			->setTo($to)
			->setBody($body)
		;
		$this->mailer->send($message);
	}

	public function sendEmailWithAttachments($from, $to, $subject, $body, Array $paths)
	{
		$message = \Swift_Message::newInstance()
			->setContentType('text/html')
			->setSubject($subject)
			->setFrom($from)
			->setTo($to)
			->setBody($body)
		;
		
		foreach($paths as $path)
		{
			$attachment = \Swift_Attachment::fromPath(realpath($path));
			$message->attach($attachment);
		}
		
		$this->mailer->send($message);
	}
}
?>
