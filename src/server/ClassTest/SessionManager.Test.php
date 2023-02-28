<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class SessionManagerTest extends TestCase
{
    public function testSessionManager(): void
    {
        $session = new SessionManager;

        $session = $session->start();

        $this->assertSame(true, $session);
    }
}