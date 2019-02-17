<?php
/**
 * Created by PhpStorm.
 * User: Sony
 * Date: 17/02/2019
 * Time: 13:24
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;



class RegisterController extends Controller
{
	/**
	 * @param UserPasswordEncoderInterface $passwordEncoder
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @Route("/register", name="user_register")
	 */
	public function register(UserPasswordEncoderInterface $passwordEncoder, Request $request)
{
	$user = new User();
	$form = $this->createForm(
	UserType::class, $user
	);
	$form->handleRequest($request);

	if ($form->isSubmitted() && $form->isValid())
	{
		$password = $passwordEncoder->encodePassword(
			$user,
			$user->getPlainPassword()
		);
		$user->setPassword($password);

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($user);
		$entityManager->flush();
		$this->redirectToRoute('micro_post_index');
	}
	return $this->render('register/register.html.twig', [
		'form' => $form->createView()
	]);
}

}